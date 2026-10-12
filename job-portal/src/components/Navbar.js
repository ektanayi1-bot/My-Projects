import { Navbar, Nav, Container, Button } from "react-bootstrap";
import { Link, useNavigate } from "react-router-dom";
import { useAuth } from "../context/AuthContext";

function AppNavbar() {
  const { user, logout } = useAuth();
  const navigate = useNavigate();

  const handleLogout = () => {
    logout();
    navigate("/");
  };

  return (
    <Navbar expand="lg" bg="white" className="shadow-sm sticky-top py-3">
      <Container>
        <Navbar.Brand as={Link} to="/" className="fw-bold fs-4 text-primary">
          <i className="bi bi-briefcase-fill me-2"></i>JobPortal
        </Navbar.Brand>
        <Navbar.Toggle aria-controls="main-nav" />
        <Navbar.Collapse id="main-nav">
          <Nav className="mx-auto">
            <Nav.Link as={Link} to="/">Home</Nav.Link>
            <Nav.Link as={Link} to="/jobs">Find Jobs</Nav.Link>
            {user?.role === "employer" && (
              <Nav.Link as={Link} to="/post-job">Post a Job</Nav.Link>
            )}
            {user && <Nav.Link as={Link} to="/dashboard">Dashboard</Nav.Link>}
          </Nav>

          <div className="d-flex align-items-center gap-2 mt-3 mt-lg-0">
            {user ? (
              <>
                <span className="text-muted me-2">
                  <i className="bi bi-person-circle me-1"></i>{user.name}
                </span>
                <Button variant="outline-danger" onClick={handleLogout}>Logout</Button>
              </>
            ) : (
              <>
                <Button as={Link} to="/login" variant="outline-primary">Login</Button>
                <Button as={Link} to="/register" variant="primary">Sign Up</Button>
              </>
            )}
          </div>
        </Navbar.Collapse>
      </Container>
    </Navbar>
  );
}

export default AppNavbar;