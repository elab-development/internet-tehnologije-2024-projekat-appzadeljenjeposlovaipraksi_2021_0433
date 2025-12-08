import React, { useState } from "react";
import "./Login.css";
import { auth } from "../../firebase";
import { signInWithEmailAndPassword } from "firebase/auth";
import { Link, useNavigate } from "react-router-dom";

function Login() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [error, setError] = useState("");
  const navigate = useNavigate();

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      await signInWithEmailAndPassword(auth, email, password);
      navigate("/"); 
    } catch (err) {
      setError("Pogrešan email ili lozinka");
    }
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




