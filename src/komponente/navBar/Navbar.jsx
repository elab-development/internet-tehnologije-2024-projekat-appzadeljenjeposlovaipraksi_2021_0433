import React from 'react';
import { IoMenuSharp } from "react-icons/io5";
import logo from '../../assets/logo.png';
import './Navbar.css';

function Navbar() {
  return (
   
    
    <nav className='container'>
    <img src={logo} alt="logo" className='logo' />
    <ul>
      <li>Početna</li>
      <li>Oglasi</li>
      <li>Kompanije</li>
      <li>Moj profil</li>
      <li>Kontakt</li>


    </ul>
       
    </nav>
    
 
  )
}

export default Navbar