import { useState } from "react";
import { Container, Row, Col, Form, Spinner, Alert } from "react-bootstrap";
import JobCard from "../components/JobCard";
import { getJobs } from "../services/jobService";
import useFetch from "../hooks/useFetch";

function Jobs() {
  const [search, setSearch] = useState("");
  const [type, setType] = useState("");
  const [category, setCategory] = useState("");

  const { data: jobs, loading, error } = useFetch(
    () =>
      getJobs({
        q: search || undefined,
        type: type || undefined,
        category: category || undefined,
        _sort: "postedDate",
        _order: "desc",
      }),
    [search, type, category]
  );

  return (
    <Container className="py-5">
      <h2 className="fw-bold mb-4">Find Jobs</h2>

      <Row className="mb-4 g-2">
        <Col md={6}>
          <Form.Control
            placeholder="Search by title, company or location"
            value={search}
            onChange={(e) => setSearch(e.target.value)}
          />
        </Col>
        <Col md={3}>
          <Form.Select value={type} onChange={(e) => setType(e.target.value)}>
            <option value="">All Types</option>
            <option>Full-time</option>
            <option>Part-time</option>
            <option>Internship</option>
          </Form.Select>
        </Col>
        <Col md={3}>
          <Form.Select value={category} onChange={(e) => setCategory(e.target.value)}>
            <option value="">All Categories</option>
            <option>IT</option>
            <option>Design</option>
            <option>Marketing</option>
            <option>Data</option>
            <option>Content</option>
            <option>Finance</option>
          </Form.Select>
        </Col>
      </Row>

      {loading && (
        <div className="text-center">
          <Spinner animation="border" variant="primary" />
        </div>
      )}
      {error && <Alert variant="danger">{error}</Alert>}
      {!loading && !error && jobs.length === 0 && (
        <p className="text-center text-muted">No jobs found.</p>
      )}

      <Row className="g-4">
        {jobs.map((job) => (
          <Col md={6} lg={4} key={job.id}>
            <JobCard job={job} />
          </Col>
        ))}
      </Row>
    </Container>
  );
}

export default Jobs;