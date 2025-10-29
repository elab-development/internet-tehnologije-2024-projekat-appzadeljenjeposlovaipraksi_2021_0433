import React, { useEffect, useState } from 'react';
import { IoMenuSharp } from "react-icons/io5";
import logo from '../../assets/logo.png';
import './Navbar.css';
import { Link, useLocation } from 'react-router-dom';


function Navbar() {

const[sticky, setSticky]=useState(false);
const location=useLocation();
useEffect(()=>{
  if(location.pathname==='/'){
  window.addEventListener('scroll', () =>{
    window.scrollY > 50 ? setSticky(true) : setSticky(false)
  })} else{
    setSticky(true);
  }
}, []);

  return (
   
    
    <nav className={`container ${sticky? 'dark-nav' : ''}`}>
    <img src={logo} alt="logo" className='logo' />
    <ul>
      <Link to="/">
      <li>Početna</li>
      </Link>
      <Link to="/oglasi">
      <li>Oglasi</li>
      </Link>
      <Link to="/kompanije">
      <li>Kompanije</li>
      </Link>
      <Link to="/mojProfil">
      <li>Moj profil</li>
      </Link>
      <Link to="/kontakt">
      <li>Kontakt</li>
      </Link>


    </ul>
       
    </nav>
    
 
  )
}

export default Navbar