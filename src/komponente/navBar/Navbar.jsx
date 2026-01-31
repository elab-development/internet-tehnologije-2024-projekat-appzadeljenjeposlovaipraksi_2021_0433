import React, { useEffect, useState } from 'react';
import logo from '../../assets/mojLogo.png';
import './Navbar.css';
import { Link, useLocation, useNavigate } from 'react-router-dom';
import { signOut } from "firebase/auth";
import { auth } from "../../firebase";

function Navbar() {
  const [sticky, setSticky] = useState(false);
  const location = useLocation();
  const navigate = useNavigate();

  useEffect(() => {
    const handleScroll = () => {
      setSticky(window.scrollY > 50);
    };

    if (location.pathname === "/") {
      window.addEventListener("scroll", handleScroll);
      return () => window.removeEventListener("scroll", handleScroll);
    } else {
      setSticky(true);
    }
  }, [location]);

  const handleLogout = async () => {
    try {
      await signOut(auth);
      navigate("/login");
    } catch (error) {
      console.error("Greška prilikom odjave:", error);
    }
  };

  return (
    <nav className={`container ${sticky ? 'dark-nav' : ''}`}>
      <img src={logo} alt="logo" className='logo' />
      <ul>
        <Link to="/"><li>Početna</li></Link>
        <Link to="/oglasi"><li>Oglasi</li></Link>
        <Link to="/kompanije"><li>Kompanije</li></Link>
        <Link to="/mojProfil"><li>Moj profil</li></Link>
        <Link to="/kontakt"><li>Kontakt</li></Link>

        {/* 🔹 Logout kao link */}
        <li onClick={handleLogout} className="logout-link">
          Odjavi se
        </li>
      </ul>
    </nav>
  );
}

export default Navbar;

