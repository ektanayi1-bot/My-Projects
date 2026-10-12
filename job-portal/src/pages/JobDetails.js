import { useState } from "react";
import { useParams, useNavigate } from "react-router-dom";
import { Container, Badge, Button, Spinner, Alert, Modal, Form } from "react-bootstrap";
import { getJobById, applyToJob } from "../services/jobService";
import useFetch from "../hooks/useFetch";
import { useAuth } from "../context/AuthContext";

function JobDetails() {
  const { id } = useParams();
  const { user } = useAuth();
  const navigate = useNavigate();
  const { data: job, loading, error } = useFetch(() => getJobById(id), [id]);

  const [show, setShow] = useState(false);
  const [coverLetter, setCoverLetter] = useState("");
  const [applying, setApplying] = useState(false);
  const [message, setMessage] = useState({ type: "", text: "" });

  const handleApplyClick = () => {
    if (!user) return navigate("/login");
    if (user.role !== "jobseeker") {
      return setMessage({ type: "warning", text: "Only job seeker accounts can apply." });
    }
    setShow(true);
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setApplying(true);
    try {
      await applyToJob({
        jobId: Number(id),
        userId: user.id,
        name: user.name,
        email: user.email,
        phone: user.phone,
        coverLetter,
        status: "Pending",
        appliedDate: new Date().toISOString().slice(0, 10),
      });
      setShow(false);
      setCoverLetter("");
      setMessage({ type: "success", text: "Application submitted successfully!" });
    } catch {
      setMessage({ type: "danger", text: "Could not submit. Please try again." });
    } finally {
      setApplying(false);
    }
  };

  if (loading) return <div className="text-center py-5"><Spinner animation="border" variant="primary" /></div>;
  if (error) return <Container className="py-5"><Alert variant="danger">Job not found.</Alert></Container>;

  return (
    <Container className="py-5">
      {message.text && <Alert variant={message.type} dismissible onClose={() => setMessage({ type: "", text: "" })}>{message.text}</Alert>}

      <div className="bg-white p-4 p-md-5 rounded-4 shadow-sm">
        <div className="d-flex align-items-center gap-3 mb-3">
          <div className="company-logo">{job.company?.charAt(0)}</div>
          <div>
            <h2 className="fw-bold mb-0">{job.title}</h2>
            <p className="text-muted mb-0">{job.company} • {job.location}</p>
          </div>
        </div>

        <div className="mb-3">
          <Badge bg="primary" className="me-2">{job.type}</Badge>
          <Badge bg="success" className="me-2">{job.salary}</Badge>
          {job.experience && <Badge bg="secondary">{job.experience}</Badge>}
        </div>

        <hr />
        <h5>Job Description</h5>
        <p>{job.description}</p>

        {job.skills && (
          <>
            <h5>Skills Required</h5>
            <div className="mb-4">
              {job.skills.map((s) => (
                <Badge key={s} bg="light" text="dark" className="border me-2 p-2">{s}</Badge>
              ))}
            </div>
          </>
        )}

        <Button variant="primary" size="lg" onClick={handleApplyClick}>Apply Now</Button>
      </div>

      <Modal show={show} onHide={() => setShow(false)} centered>
        <Form onSubmit={handleSubmit}>
          <Modal.Header closeButton><Modal.Title>Apply for {job.title}</Modal.Title></Modal.Header>
          <Modal.Body>
            <Form.Group>
              <Form.Label>Cover Letter</Form.Label>
              <Form.Control as="textarea" rows={5} value={coverLetter} onChange={(e) => setCoverLetter(e.target.value)} placeholder="Tell the employer why you are a good fit..." required />
            </Form.Group>
          </Modal.Body>
          <Modal.Footer>
            <Button variant="secondary" onClick={() => setShow(false)}>Cancel</Button>
            <Button type="submit" variant="primary" disabled={applying}>
              {applying ? <Spinner size="sm" animation="border" /> : "Submit Application"}
            </Button>
          </Modal.Footer>
        </Form>
      </Modal>
    </Container>
  );
}

export default JobDetails;