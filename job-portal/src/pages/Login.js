import { useState } from "react";
import { Container, Row, Col, Card, Form, Button, Alert, Spinner } from "react-bootstrap";
import { Link, useNavigate } from "react-router-dom";
import { loginUser } from "../services/jobService";
import { useAuth } from "../context/AuthContext";

function Login() {
  const [form, setForm] = useState({ email: "", password: "" });
  const [error, setError] = useState("");
  const [loading, setLoading] = useState(false);
  const { login } = useAuth();
  const navigate = useNavigate();

  const handleChange = (e) => setForm({ ...form, [e.target.name]: e.target.value });

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError("");
    setLoading(true);
    try {
      const res = await loginUser(form.email, form.password);
      if (res.data.length === 1) {
        login(res.data[0]);
        navigate("/dashboard");
      } else {
        setError("Invalid email or password.");
      }
    } catch {
      setError("Server error. Is the API running?");
    } finally {
      setLoading(false);
    }
  };

  return (
    <Container className="py-5">
      <Row className="justify-content-center">
        <Col md={6} lg={5}>
          <Card className="border-0 shadow rounded-4">
            <Card.Body className="p-4 p-md-5">
              <h3 className="fw-bold text-center mb-1">Welcome Back</h3>
              <p className="text-muted text-center mb-4">Login to your account</p>

              {error && <Alert variant="danger">{error}</Alert>}

              <Form onSubmit={handleSubmit}>
                <Form.Group className="mb-3">
                  <Form.Label>Email</Form.Label>
                  <Form.Control type="email" name="email" value={form.email} onChange={handleChange} placeholder="you@example.com" required />
                </Form.Group>
                <Form.Group className="mb-4">
                  <Form.Label>Password</Form.Label>
                  <Form.Control type="password" name="password" value={form.password} onChange={handleChange} placeholder="Enter password" required />
                </Form.Group>
                <Button type="submit" variant="primary" size="lg" className="w-100" disabled={loading}>
                  {loading ? <Spinner size="sm" animation="border" /> : "Login"}
                </Button>
              </Form>

              <p className="text-center mt-4 mb-0">
                New here? <Link to="/register">Create an account</Link>
              </p>
            </Card.Body>
          </Card>
        </Col>
      </Row>
    </Container>
  );
}

export default Login;