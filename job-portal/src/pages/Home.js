import { Container, Row, Col, Form, Button, Spinner, Alert } from "react-bootstrap";
import { Link } from "react-router-dom";
import JobCard from "../components/JobCard";
import { getJobs } from "../services/jobService";
import useFetch from "../hooks/useFetch";
const categories = [
  { name: "IT", icon: "bi-laptop" },
  { name: "Design", icon: "bi-palette" },
  { name: "Marketing", icon: "bi-megaphone" },
  { name: "Data", icon: "bi-bar-chart" },
  { name: "Content", icon: "bi-pencil-square" },
  { name: "Finance", icon: "bi-currency-rupee" },
];

function Home() {
  const { data: jobs, loading, error } = useFetch(() =>
    getJobs({ _sort: "postedDate", _order: "desc", _limit: 6 })
  );

  return (
    <>
      {/* Hero */}
      <section className="hero text-white text-center d-flex align-items-center">
        <Container>
          <h1 className="display-4 fw-bold">Find Your Dream Job Today</h1>
          <p className="lead mb-4">Thousands of jobs from top companies, all in one place.</p>
          <Form className="mx-auto" style={{ maxWidth: 750 }}>
            <Row className="g-2">
              <Col md={5}>
                <Form.Control size="lg" placeholder="Job title or keyword" />
              </Col>
              <Col md={4}>
                <Form.Control size="lg" placeholder="Location" />
              </Col>
              <Col md={3}>
                <Button as={Link} to="/jobs" size="lg" variant="warning" className="w-100 fw-semibold">
                  <i className="bi bi-search me-2"></i>Search
                </Button>
              </Col>
            </Row>
          </Form>
        </Container>
      </section>

      {/* Stats */}
      <Container className="stats-box">
        <Row className="bg-white rounded-4 shadow text-center py-4 g-3 mx-1">
          <Col xs={6} md={3}>
            <h3 className="fw-bold text-primary">10K+</h3>
            <p className="text-muted mb-0">Live Jobs</p>
          </Col>
          <Col xs={6} md={3}>
            <h3 className="fw-bold text-primary">2K+</h3>
            <p className="text-muted mb-0">Companies</p>
          </Col>
          <Col xs={6} md={3}>
            <h3 className="fw-bold text-primary">50K+</h3>
            <p className="text-muted mb-0">Candidates</p>
          </Col>
          <Col xs={6} md={3}>
            <h3 className="fw-bold text-primary">5K+</h3>
            <p className="text-muted mb-0">Hired</p>
          </Col>
        </Row>
      </Container>

      {/* Categories */}
      <Container className="py-5">
        <h2 className="text-center fw-bold mb-4">Browse by Category</h2>
        <Row className="g-3">
          {categories.map((c) => (
            <Col xs={6} md={4} lg={2} key={c.name}>
              <div className="category-box text-center p-4 bg-white rounded-4 shadow-sm">
                <i className={`bi ${c.icon} fs-1 text-primary`}></i>
                <p className="fw-semibold mt-2 mb-0">{c.name}</p>
              </div>
            </Col>
          ))}
        </Row>
      </Container>

      {/* Latest jobs */}
      <Container className="pb-4">
        <h2 className="text-center fw-bold mb-4">Latest Jobs</h2>

        {loading && (
          <div className="text-center">
            <Spinner animation="border" variant="primary" />
          </div>
        )}
        {error && <Alert variant="danger">{error}</Alert>}

        <Row className="g-4">
          {(Array.isArray(jobs) ? jobs : []).map((job) => (
            <Col md={6} lg={4} key={job.id}>
              <JobCard job={job} />
            </Col>
          ))}
        </Row>

        <div className="text-center mt-4">
          <Button as={Link} to="/jobs" variant="primary" size="lg">
            View All Jobs
          </Button>
        </div>
      </Container>
    </>
  );
}

export default Home;