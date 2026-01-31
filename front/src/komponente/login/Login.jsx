import React, { useState } from "react";
import "./Login.css";
import { Link, useNavigate } from "react-router-dom";
import api from '../../api/api';
import axios from "axios";

function Login() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [error, setError] = useState("");
  const navigate = useNavigate();

  const handleSubmit = async (e) => {
    e.preventDefault();
    console.log({ email, password });
  axios.post("http://127.0.0.1:8000/api/login", { email, password },{ withCredentials: true })
  .then((res) => {
    console.log(res.data);
    localStorage.setItem("token", res.data.access_token);
    navigate("/"); // preusmjeri na početnu
  })
  .catch((err) => {
    console.error(err);
    setError("Pogrešan email ili lozinka");
  });



  };

  return (
    <div className="login-all"><div className="login-container">
      <h2>Dobrodošli u Praksion</h2>
      <p className="welcome-text">
        Vaša platforma za povezivanje sa vodećim kompanijama i praksama.
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
        {error && <p style={{ color: "red" }}>{error}</p>}
        <button type="submit">Prijavi se</button>
        <p style={{ marginTop: "15px" }}>
          Nemaš nalog? <Link to="/register">Registruj se</Link>
        </p>
      </form>
    </div>
    </div>
    
  );
}

export default Login;




