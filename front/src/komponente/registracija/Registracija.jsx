import React, { useState } from "react";
import "./Registracija.css";
import { Link, useNavigate } from "react-router-dom";
import axios from "axios";

function Register() {
    const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [ime, setIme] = useState("");
  const [prezime, setPrezime] = useState("");

  const [error, setError] = useState("");
  const navigate = useNavigate();

  const handleSubmit = async (e) => {
    e.preventDefault();
     console.log({ email, password });
   axios.post("http://127.0.0.1:8000/api/register", { email, password,ime, prezime })
  .then((res) => {
    console.log(res.data);
    localStorage.setItem("token", res.data.access_token);
    navigate("/"); // preusmjeri na početnu
  })
  .catch((err) => {
    console.error(err);
    setError("Uneti podaci nisu ispravni");
  });
    
  };

  return (
    <div className="register-all"><div className="register-container">
      <h2>Kreiraj nalog</h2>
      <p className="welcome-text">
        Pridruži se Praksion zajednici i započni svoju praksu!
      </p>
      <form onSubmit={handleSubmit}>
        <div className="form-group">
          <label>Email:</label>
          <input 
            type="email" 
            value={email} 
            onChange={(e) => setEmail(e.target.value)} 
            required 
          />
        </div>
        <div className="form-group">
          <label>Lozinka:</label>
          <input 
            type="password" 
            value={password} 
            onChange={(e) => setPassword(e.target.value)} 
            required 
          />
        </div>
           <div className="form-group">
          <label>Ime:</label>
          <input 
            type="text" 
            value={ime} 
            onChange={(e) => setIme(e.target.value)} 
            required 
          />
        </div>
          <div className="form-group">
          <label>Prezime:</label>
          <input 
            type="text" 
            value={prezime} 
            onChange={(e) => setPrezime(e.target.value)} 
            required 
          />
        </div>
        {error && <p style={{ color: "red" }}>{error}</p>}
        <button type="submit">Registruj se</button>
        <p className="login-link">
          Već imaš nalog? <Link to="/login">Prijavi se</Link>
        </p>
      </form>
    </div>
    </div>
    
  );
}

export default Register;

