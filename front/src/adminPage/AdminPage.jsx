import React, { useEffect, useState } from "react";
import axios from "axios";
import "./AdminPage.css";

function AdminPage() {
  const [users, setUsers] = useState([]);
  const [companies, setCompanies] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");

  // 🔹 Dohvati sve korisnike
  async function getUsers() {
    try {
      const res = await axios.get("http://localhost:8000/api/users", {
        headers: { Authorization: `Bearer ${localStorage.getItem("token")}` }
      });
      setUsers(res.data);
    } catch (err) {
      setError("Greška pri dohvaćanju korisnika");
    }
  }

  // 🔹 Dohvati sve kompanije
  async function getCompanies() {
    try {
      const res = await axios.get("http://localhost:8000/api/kompanije", {
        headers: { Authorization: `Bearer ${localStorage.getItem("token")}` }
      });
      setCompanies(res.data);
    } catch (err) {
      setError("Greška pri dohvaćanju kompanija");
    }
  }

  // 🔹 Brisanje korisnika
  async function deleteUser(id) {
    try {
      await axios.delete(`http://localhost:8000/api/users/${id}`, {
        headers: { Authorization: `Bearer ${localStorage.getItem("token")}` }
      });
      setUsers(users.filter(u => u.id !== id));
    } catch (err) {
      alert("Greška pri brisanju korisnika");
    }
  }

  // 🔹 Brisanje kompanije
  async function deleteCompany(id) {
    try {
      await axios.delete(`http://localhost:8000/api/kompanije/${id}`, {
        headers: { Authorization: `Bearer ${localStorage.getItem("token")}` }
      });
      setCompanies(companies.filter(c => c.id !== id));
    } catch (err) {
      alert("Greška pri brisanju kompanije");
    }
  }

  // 🔹 Ažuriranje korisnika (primjer: promjena imena)
  async function updateUser(id, newName) {
    try {
      await axios.put(
        `http://localhost:8000/api/users/${id}`,
        { name: newName },
        { headers: { Authorization: `Bearer ${localStorage.getItem("token")}` } }
      );
      setUsers(users.map(u => (u.id === id ? { ...u, name: newName } : u)));
    } catch (err) {
      alert("Greška pri ažuriranju korisnika");
    }
  }

  // 🔹 Ažuriranje kompanije (primjer: promjena naziva)
  async function updateCompany(id, newName) {
    try {
      await axios.put(
        `http://localhost:8000/api/kompanije/${id}`,
        { naziv: newName },
        { headers: { Authorization: `Bearer ${localStorage.getItem("token")}` } }
      );
      setCompanies(companies.map(c => (c.id === id ? { ...c, naziv: newName } : c)));
    } catch (err) {
      alert("Greška pri ažuriranju kompanije");
    }
  }

  useEffect(() => {
    getUsers();
    getCompanies();
    setLoading(false);
  }, []);

  if (loading) return <p>Učitavanje...</p>;

  return (
    <div className="admin-page">
      <h1>Admin Panel</h1>
      {error && <p style={{ color: "red" }}>{error}</p>}

      <div className="admin-section">
        <h2>Korisnici</h2>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Email</th>
              <th>Ime</th>
              <th>Akcije</th>
            </tr>
          </thead>
          <tbody>
            {users.map(user => (
              <tr key={user.id}>
                <td>{user.id}</td>
                <td>{user.email}</td>
                <td>{user.name}</td>
                <td>
                  <button onClick={() => deleteUser(user.id)}>Obriši</button>
                  <button
                    onClick={() => {
                      const newName = prompt("Unesi novo ime:", user.name);
                      if (newName) updateUser(user.id, newName);
                    }}
                  >
                    Izmeni
                  </button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>

      <div className="admin-section">
        <h2>Kompanije</h2>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Naziv</th>
              <th>Email</th>
              <th>Akcije</th>
            </tr>
          </thead>
          <tbody>
            {companies.map(comp => (
              <tr key={comp.id}>
                <td>{comp.id}</td>
                <td>{comp.naziv}</td>
                <td>{comp.email}</td>
                <td>
                  <button onClick={() => deleteCompany(comp.id)}>Obriši</button>
                  <button
                    onClick={() => {
                      const newName = prompt("Unesi novi naziv:", comp.naziv);
                      if (newName) updateCompany(comp.id, newName);
                    }}
                  >
                    Izmeni
                  </button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </div>
  );
}

export default AdminPage;
