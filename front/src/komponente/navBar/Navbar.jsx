import React, { useEffect, useState } from 'react';
import logo from '../../assets/mojLogo.png';
import './Navbar.css';
import { Link, useLocation, useNavigate } from 'react-router-dom';
import { signOut } from "firebase/auth";
import { auth } from "../../firebase";
import api from '../../api/api';


function Navbar() {
  const [sticky, setSticky] = useState(false);
  const [isAuthenticated, setIsAuthenticated] = useState(false);
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
    
    try{

    await api.post("/logout");

    }
    catch(err){
      console.log("Greska pri logout-u",err)
    }
    finally{
      localStorage.removeItem("token");
      localStorage.removeItem("user");
      sessionStorage.removeItem("token");
      sessionStorage.removeItem("user");

      setIsAuthenticated(false);
      navigate("/login")
    }
  };

  useEffect(() => {
    const token = localStorage.getItem("token") || sessionStorage.getItem("token");
    setIsAuthenticated(!!token);
  }, [location]);

  return (
    <nav className={`container ${sticky ? 'dark-nav' : ''}`}>
      <img src={logo} alt="logo" className='logo' />
      <ul>
        <Link to="/"><li>Početna</li></Link>
        <Link to="/kompanije"><li>Kompanije</li></Link>
        <Link to="/kontakt"><li>Kontakt</li></Link>

        
      {isAuthenticated ? (
         <>
        <Link to="/oglasi"><li>Oglasi</li></Link>
        <Link to="/mojProfil"><li>Moj profil</li></Link>
        <button
        type='button'
        className='logout'
        onClick={handleLogout}>
          Logout
        </button>
      </>
      ) : (
       <>
       <Link to="/login"><li>Login</li></Link>
       <Link to="/register"><li>Registracija</li></Link>

       </>
      )
     
      }
        
      </ul>
    </nav>
  );
}

export default Navbar;

