import api from "./api";

// Jobs
export const getJobs = (params = {}) => api.get("/jobs", { params });
export const getJobById = (id) => api.get(`/jobs/${id}`);
export const createJob = (data) => api.post("/jobs", data);
export const updateJob = (id, data) => api.put(`/jobs/${id}`, data);
export const deleteJob = (id) => api.delete(`/jobs/${id}`);
export const getJobsByEmployer = (userId) => api.get("/jobs", { params: { postedBy: userId } });

// Applications
export const applyToJob = (data) => api.post("/applications", data);
export const getApplications = () => api.get("/applications");
export const getUserApplications = (userId) =>
  api.get("/applications", { params: { userId, _expand: "job" } });

// Companies and categories
export const getCompanies = () => api.get("/companies");
export const getCategories = () => api.get("/categories");

// Users
export const loginUser = (email, password) =>
  api.get("/users", { params: { email, password } });
export const registerUser = (data) => api.post("/users", data);
export const getUserByEmail = (email) => api.get("/users", { params: { email } });

// Saved jobs
export const getSavedJobs = (userId) =>
  api.get("/savedJobs", { params: { userId, _expand: "job" } });
export const saveJob = (data) => api.post("/savedJobs", data);
export const removeSavedJob = (id) => api.delete(`/savedJobs/${id}`);