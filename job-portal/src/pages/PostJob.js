import { useState } from "react";
import { Container, Row, Col, Card, Form, Button, Alert, Spinner } from "react-bootstrap";
import { Navigate, useNavigate } from "react-router-dom";
import { createJob } from "../services/jobService";
import { useAuth } from "../context/AuthContext";

function PostJob() {
  const { user } = useAuth();
  const navigate = useNavigate();
  const [form, setForm] = useState({
    title: "", company: "", location: "", type: "Full-time", salary: "",
    category: "IT", experience: "", skills: "", vacancies: 1, description: "",
  });
  const [error, setError] = useState("");
  const [loading, setLoading] = useState(false);

  if (!user) return <Navigate to="/login" />;
  if (user.role !== "employer") {
    return <Container className="py-5"><Alert variant="warning">Only employer accounts can post jobs.</Alert></Container>;
  }

  const handleChange = (e) => setForm({ ...form, [e.target.name]: e.target.value });

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError("");
    setLoading(true);
    try {
      await createJob({
        ...form,
        vacancies: Number(form.vacancies),
        skills: form.skills.split(",").map((s) => s.trim()).filter(Boolean),
        postedBy: user.id,
        postedDate: new Date().toISOString().slice(0, 10),
      });
      navigate("/dashboard");
    } catch {
      setError("Could not post the job. Please try again.");
    } finally {
      setLoading(false);
    }
  };

  return (
    <Container className="py-5">
      <Row className="justify-content-center">
        <Col lg={8}>
          <Card className="border-0 shadow rounded-4">
            <Card.Body className="p-4 p-md-5">
              <h3 className="fw-bold mb-4"><i className="bi bi-plus-circle me-2 text-primary"></i>Post a New Job</h3>
              {error && <Alert variant="danger">{error}</Alert>}

              <Form onSubmit={handleSubmit}>
                <Row>
                  <Col md={6}>
                    <Form.Group className="mb-3">
                      <Form.Label>Job Title</Form.Label>
                      <Form.Control name="title" value={form.title} onChange={handleChange} required />
                    </Form.Group>
                  </Col>
                  <Col md={6}>
                    <Form.Group className="mb-3">
                      <Form.Label>Company Name</Form.Label>
                      <Form.Control name="company" value={form.company} onChange={handleChange} required />
                    </Form.Group>
                  </Col>
                  <Col md={6}>
                    <Form.Group className="mb-3">
                      <Form.Label>Location</Form.Label>
                      <Form.Control name="location" value={form.location} onChange={handleChange} required />
                    </Form.Group>
                  </Col>
                  <Col md={6}>
                    <Form.Group className="mb-3">
                      <Form.Label>Salary</Form.Label>
                      <Form.Control name="salary" placeholder="e.g. ₹4-6 LPA" value={form.salary} onChange={handleChange} required />
                    </Form.Group>
                  </Col>
                  <Col md={4}>
                    <Form.Group className="mb-3">
                      <Form.Label>Job Type</Form.Label>
                      <Form.Select name="type" value={form.type} onChange={handleChange}>
                        <option>Full-time</option>
                        <option>Part-time</option>
                        <option>Internship</option>
                      </Form.Select>
                    </Form.Group>
                  </Col>
                  <Col md={4}>
                    <Form.Group className="mb-3">
                      <Form.Label>Category</Form.Label>
                      <Form.Select name="category" value={form.category} onChange={handleChange}>
                        <option>IT</option>
                        <option>Design</option>
                        <option>Marketing</option>
                        <option>Data</option>
                        <option>Content</option>
                        <option>Finance</option>
                      </Form.Select>
                    </Form.Group>
                  </Col>
                  <Col md={4}>
                    <Form.Group className="mb-3">
                      <Form.Label>Vacancies</Form.Label>
                      <Form.Control type="number" min="1" name="vacancies" value={form.vacancies} onChange={handleChange} />
                    </Form.Group>
                  </Col>
                  <Col md={6}>
                    <Form.Group className="mb-3">
                      <Form.Label>Experience</Form.Label>
                      <Form.Control name="experience" placeholder="e.g. 1-3 years" value={form.experience} onChange={handleChange} />
                    </Form.Group>
                  </Col>
                  <Col md={6}>
                    <Form.Group className="mb-3">
                      <Form.Label>Skills (comma separated)</Form.Label>
                      <Form.Control name="skills" placeholder="React, Node.js, MySQL" value={form.skills} onChange={handleChange} />
                    </Form.Group>
                  </Col>
                </Row>
                <Form.Group className="mb-4">
                  <Form.Label>Description</Form.Label>
                  <Form.Control as="textarea" rows={5} name="description" value={form.description} onChange={handleChange} required />
                </Form.Group>
                <Button type="submit" variant="primary" size="lg" disabled={loading}>
                  {loading ? <Spinner size="sm" animation="border" /> : "Post Job"}
                </Button>
              </Form>
            </Card.Body>
          </Card>
        </Col>
      </Row>
    </Container>
  );
}

export default PostJob;