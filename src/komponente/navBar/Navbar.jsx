import React, { useEffect, useState } from 'react';
import { IoMenuSharp } from "react-icons/io5";
import logo from '../../assets/logo.png';
import './Navbar.css';

function Navbar() {

const[sticky, setSticky]=useState(false);
useEffect(()=>{
  window.addEventListener('scroll', () =>{
    window.scrollY > 50 ? setSticky(true) : setSticky(false)
  })
}, []);

  return (
   
    
    <nav className={`container ${sticky? 'dark-nav' : ''}`}>
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