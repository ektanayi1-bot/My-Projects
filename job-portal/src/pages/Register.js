import { useState } from "react";
import { Container, Row, Col, Card, Form, Button, Alert, Spinner } from "react-bootstrap";
import { Link, useNavigate } from "react-router-dom";
import { registerUser, getUserByEmail } from "../services/jobService";
import { useAuth } from "../context/AuthContext";

function Register() {
  const [form, setForm] = useState({
    name: "", email: "", phone: "", password: "", confirm: "", role: "jobseeker",
  });
  const [error, setError] = useState("");
  const [loading, setLoading] = useState(false);
  const { login } = useAuth();
  const navigate = useNavigate();

  const handleChange = (e) => setForm({ ...form, [e.target.name]: e.target.value });

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError("");

    if (form.password.length < 6) return setError("Password must be at least 6 characters.");
    if (form.password !== form.confirm) return setError("Passwords do not match.");

    setLoading(true);
    try {
      const existing = await getUserByEmail(form.email);
      if (existing.data.length > 0) {
        setError("This email is already registered.");
        return;
      }
      const { confirm, ...data } = form;
      const res = await registerUser(data);
      login(res.data);
      navigate("/dashboard");
    } catch {
      setError("Server error. Is the API running?");
    } finally {
      setLoading(false);
    }
  };

  return (
    <Container className="py-5">
      <Row className="justify-content-center">
        <Col md={8} lg={6}>
          <Card className="border-0 shadow rounded-4">
            <Card.Body className="p-4 p-md-5">
              <h3 className="fw-bold text-center mb-1">Create Account</h3>
              <p className="text-muted text-center mb-4">Join thousands of job seekers and employers</p>

              {error && <Alert variant="danger">{error}</Alert>}

              <Form onSubmit={handleSubmit}>
                <Form.Group className="mb-3">
                  <Form.Label>I am a</Form.Label>
                  <Form.Select name="role" value={form.role} onChange={handleChange}>
                    <option value="jobseeker">Job Seeker</option>
                    <option value="employer">Employer</option>
                  </Form.Select>
                </Form.Group>
                <Form.Group className="mb-3">
                  <Form.Label>Full Name</Form.Label>
                  <Form.Control name="name" value={form.name} onChange={handleChange} required />
                </Form.Group>
                <Row>
                  <Col md={7}>
                    <Form.Group className="mb-3">
                      <Form.Label>Email</Form.Label>
                      <Form.Control type="email" name="email" value={form.email} onChange={handleChange} required />
                    </Form.Group>
                  </Col>
                  <Col md={5}>
                    <Form.Group className="mb-3">
                      <Form.Label>Phone</Form.Label>
                      <Form.Control name="phone" value={form.phone} onChange={handleChange} required />
                    </Form.Group>
                  </Col>
                </Row>
                <Row>
                  <Col md={6}>
                    <Form.Group className="mb-4">
                      <Form.Label>Password</Form.Label>
                      <Form.Control type="password" name="password" value={form.password} onChange={handleChange} required />
                    </Form.Group>
                  </Col>
                  <Col md={6}>
                    <Form.Group className="mb-4">
                      <Form.Label>Confirm Password</Form.Label>
                      <Form.Control type="password" name="confirm" value={form.confirm} onChange={handleChange} required />
                    </Form.Group>
                  </Col>
                </Row>
                <Button type="submit" variant="primary" size="lg" className="w-100" disabled={loading}>
                  {loading ? <Spinner size="sm" animation="border" /> : "Sign Up"}
                </Button>
              </Form>

              <p className="text-center mt-4 mb-0">
                Already have an account? <Link to="/login">Login</Link>
              </p>
            </Card.Body>
          </Card>
        </Col>
      </Row>
    </Container>
  );
}

export default Register;