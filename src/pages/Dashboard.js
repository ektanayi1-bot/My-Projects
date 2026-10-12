import { useState } from "react";
import { Container, Row, Col, Card, Table, Badge, Button, Spinner, Alert } from "react-bootstrap";
import { Link, Navigate } from "react-router-dom";
import { getUserApplications, getJobsByEmployer, deleteJob } from "../services/jobService";
import useFetch from "../hooks/useFetch";
import { useAuth } from "../context/AuthContext";

const statusColor = { Pending: "warning", Shortlisted: "info", Hired: "success", Rejected: "danger" };

function Dashboard() {
  const { user } = useAuth();
  const [reload, setReload] = useState(0);

  const { data, loading, error } = useFetch(() => {
    if (!user) return Promise.resolve({ data: [] });
    return user.role === "employer" ? getJobsByEmployer(user.id) : getUserApplications(user.id);
  }, [user, reload]);

  if (!user) return <Navigate to="/login" />;

  const handleDelete = async (id) => {
    if (!window.confirm("Delete this job?")) return;
    await deleteJob(id);
    setReload((n) => n + 1);
  };

  const isEmployer = user.role === "employer";

  return (
    <Container className="py-5">
      <h3 className="fw-bold mb-1">Hello, {user.name} 👋</h3>
      <p className="text-muted mb-4">{isEmployer ? "Manage the jobs you posted." : "Track your job applications."}</p>

      <Row className="g-3 mb-4">
        <Col sm={6} md={4}>
          <Card className="border-0 shadow-sm rounded-4 text-center p-3">
            <h2 className="fw-bold text-primary mb-0">{data.length}</h2>
            <p className="text-muted mb-0">{isEmployer ? "Jobs Posted" : "Applications"}</p>
          </Card>
        </Col>
        {!isEmployer && (
          <Col sm={6} md={4}>
            <Card className="border-0 shadow-sm rounded-4 text-center p-3">
              <h2 className="fw-bold text-success mb-0">{data.filter((a) => a.status === "Shortlisted").length}</h2>
              <p className="text-muted mb-0">Shortlisted</p>
            </Card>
          </Col>
        )}
      </Row>

      <Card className="border-0 shadow-sm rounded-4">
        <Card.Body className="p-4">
          <div className="d-flex justify-content-between align-items-center mb-3">
            <h5 className="fw-bold mb-0">{isEmployer ? "My Posted Jobs" : "My Applications"}</h5>
            {isEmployer && <Button as={Link} to="/post-job" size="sm">+ Post New Job</Button>}
          </div>

          {loading && <div className="text-center"><Spinner animation="border" variant="primary" /></div>}
          {error && <Alert variant="danger">{error}</Alert>}
          {!loading && !error && data.length === 0 && <p className="text-muted text-center mb-0">Nothing here yet.</p>}

          {!loading && data.length > 0 && (
            <Table responsive hover className="align-middle mb-0">
              {isEmployer ? (
                <>
                  <thead><tr><th>Title</th><th>Location</th><th>Type</th><th>Posted</th><th></th></tr></thead>
                  <tbody>
                    {data.map((job) => (
                      <tr key={job.id}>
                        <td><Link to={`/jobs/${job.id}`} className="fw-semibold text-decoration-none">{job.title}</Link></td>
                        <td>{job.location}</td>
                        <td>{job.type}</td>
                        <td>{job.postedDate}</td>
                        <td className="text-end">
                          <Button size="sm" variant="outline-danger" onClick={() => handleDelete(job.id)}>
                            <i className="bi bi-trash"></i>
                          </Button>
                        </td>
                      </tr>
                    ))}
                  </tbody>
                </>
              ) : (
                <>
                  <thead><tr><th>Job</th><th>Company</th><th>Applied On</th><th>Status</th></tr></thead>
                  <tbody>
                    {data.map((app) => (
                      <tr key={app.id}>
                        <td>
                          <Link to={`/jobs/${app.jobId}`} className="fw-semibold text-decoration-none">
                            {app.job?.title || `Job #${app.jobId}`}
                          </Link>
                        </td>
                        <td>{app.job?.company}</td>
                        <td>{app.appliedDate}</td>
                        <td><Badge bg={statusColor[app.status] || "secondary"}>{app.status}</Badge></td>
                      </tr>
                    ))}
                  </tbody>
                </>
              )}
            </Table>
          )}
        </Card.Body>
      </Card>
    </Container>
  );
}

export default Dashboard;