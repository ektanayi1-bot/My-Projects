import { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import api from "../api/axios";

export default function Dashboard() {
  const [tasks, setTasks] = useState([]);
  const [title, setTitle] = useState("");
  const [error, setError] = useState("");
  const navigate = useNavigate();

  const logout = () => {
    localStorage.removeItem("token");
    navigate("/login");
  };

  useEffect(() => {
    api
      .get("/tasks")
      .then((res) => setTasks(res.data))
      .catch((err) => {
        if (err.response?.status === 401) {
          localStorage.removeItem("token");
          navigate("/login");
        } else {
          setError("Could not load tasks. Is php artisan serve running?");
        }
      });
  }, [navigate]);

  const addTask = async (e) => {
    e.preventDefault();
    try {
      const { data } = await api.post("/tasks", { title });
      setTasks([data, ...tasks]);
      setTitle("");
    } catch {
      setError("Could not add the task.");
    }
  };

  const toggle = async (t) => {
    const { data } = await api.put(`/tasks/${t.id}`, {
      title: t.title,
      is_completed: !t.is_completed,
    });
    setTasks(tasks.map((x) => (x.id === t.id ? data : x)));
  };

  const remove = async (id) => {
    await api.delete(`/tasks/${id}`);
    setTasks(tasks.filter((x) => x.id !== id));
  };

  return (
    <div className="container py-5" style={{ maxWidth: 700 }}>
      <div className="card shadow-sm border-0">
        <div className="card-body p-4">
        <div className="d-flex justify-content-between align-items-center mb-4 p-3 bg-white rounded shadow">
            <h2 className="h4 mb-0">My Tasks</h2>
            <button className="btn btn-outline-danger btn-sm" onClick={logout}>
              Logout
            </button>
          </div>

          {error && <div className="alert alert-danger py-2">{error}</div>}

          <form className="input-group mb-4" onSubmit={addTask}>
            <input
              className="form-control"
              value={title}
              onChange={(e) => setTitle(e.target.value)}
              placeholder="New task..."
              required
            />
            <button className="btn btn-primary">Add</button>
          </form>



   <ul className="list-group shadow rounded p-3 bg-white">
            {tasks.map((t) => (
             <li key={t.id} className="list-group-item d-flex align-items-center gap-3 mb-2 rounded p-3">
                <input
                  className="form-check-input mt-0"
                  type="checkbox"
                  checked={!!t.is_completed}
                  onChange={() => toggle(t)}
                />
                <span
                  className={`flex-grow-1 ${
                    t.is_completed ? "text-decoration-line-through text-muted" : ""
                  }`}
                >
                  {t.title}
                </span>
                <button className="btn btn-sm btn-outline-danger" onClick={() => remove(t.id)}>
                  Delete
                </button>
              </li>
            ))}
            {tasks.length === 0 && (
              <li className="list-group-item text-center text-muted px-0">
                No tasks yet. Add your first one above.
              </li>
            )}
          </ul>
        </div>
      </div>
    </div>
  );
}