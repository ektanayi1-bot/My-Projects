import { Card, Badge, Button } from "react-bootstrap";
import { Link } from "react-router-dom";

function JobCard({ job }) {
  return (
    <Card className="job-card h-100 border-0 shadow-sm">
      <Card.Body className="p-4">
        <div className="d-flex justify-content-between align-items-start mb-2">
          <div className="company-logo">{job.company.charAt(0)}</div>
          <Badge bg="primary" className="rounded-pill">{job.type}</Badge>
        </div>
        <Card.Title className="fw-bold mt-2">{job.title}</Card.Title>
        <Card.Subtitle className="text-muted mb-3">{job.company}</Card.Subtitle>
        <p className="small text-muted mb-1"><i className="bi bi-geo-alt me-2"></i>{job.location}</p>
        <p className="small text-muted mb-3"><i className="bi bi-cash-stack me-2"></i>{job.salary}</p>
        <Button as={Link} to={`/jobs/${job.id}`} variant="outline-primary" size="sm" className="w-100">
          View Details
        </Button>
      </Card.Body>
    </Card>
  );
}

export default JobCard;