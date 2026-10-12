import { useState } from "react";
import { useNavigate, Link } from "react-router-dom";
import api from "../api/axios";

export default function Register() {
  const [form, setForm] = useState({ name: "", email: "", password: "" });
  const [error, setError] = useState("");
  const navigate = useNavigate();

  const handleChange = (e) => setForm({ ...form, [e.target.name]: e.target.value });

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError("");
    try {
      const { data } = await api.post("/register", form);
      localStorage.setItem("token", data.token);
      navigate("/dashboard");
     } catch (err) {
      console.log(err);
      if (err.response) {
        const errors = err.response.data?.errors;
        setError(
          errors
            ? Object.values(errors).flat().join(" ")
            : err.response.data?.message || `Server error ${err.response.status}`
        );
      } else {
        setError("Cannot reach the server. Is php artisan serve running on port 8000?");
      }
    }}

  return (
    <div className="auth-box">
      <h2>Register</h2>
      {error && <p className="error">{error}</p>}
      <form onSubmit={handleSubmit}>
        <input name="name" placeholder="Name" onChange={handleChange} required />
        <input name="email" type="email" placeholder="Email" onChange={handleChange} required />
        <input name="password" type="password" placeholder="Password (min 8)" onChange={handleChange} required />
        <button type="submit">Create account</button>
      </form>
      <p>Have an account? <Link to="/login">Login</Link></p>
    </div>
  );
}