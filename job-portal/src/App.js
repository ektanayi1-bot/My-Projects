import { Routes, Route } from "react-router-dom";
import Navbar from "./components/Navbar";
import Home from "./pages/Home";
import Footer from "./components/Footer";
import Jobs from "./pages/Jobs";
import JobDetails from "./pages/JobDetails";
import Login from "./pages/Login";
import Register from "./pages/Register";
import PostJob from "./pages/PostJob";
import Dashboard from "./pages/Dashboard";

function App() {
  return (
    <>
      <Navbar />
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/jobs" element={<Jobs />} />
        <Route path="/jobs/:id" element={<JobDetails />} />
         <Route path="/login" element={<Login />} />
         <Route path="/register" element={<Register />} />
        <Route path="/post-job" element={<PostJob />} />
        <Route path="/dashboard" element={<Dashboard />} />
        <Route path="/footer" element={<Footer />} />
      </Routes>
    </>
  );
}

export default App;