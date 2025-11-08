import React, { useRef } from 'react'
import './Kompanije.css'
import m1 from '../../assets/meeting1.png'
import StavkaKompanija from './StavkaKompanija'
import { MdNavigateBefore } from "react-icons/md";
import { MdNavigateNext } from "react-icons/md";
import Naslov from '../naslov/Naslov';

function Kompanije() {
      const ulPom=useRef();
      let tx=0;
  
      const next=()=>{
        if(tx >-50){
          tx-=25
        }
        ulPom.current.style.transform=`translateX(${tx}%)`
      }
  
      const before=()=>{
        if(tx < 0){
          tx+=25
        }
        ulPom.current.style.transform=`translateX(${tx}%)`
      }
  return (
    <div className='kompanije-str'>
    <Naslov podnaslov='ostvarena je saradnja sa velikim brojem' naslov='VODECIH KOMPANIJA NA TRZISTU' />
       <button className="before-btn" onClick={before}>
            <MdNavigateBefore />
            </button>
             <button className="next-btn" onClick={next}>
            <MdNavigateNext />
            </button>
      <div className="komp-slike">
      <ul ref={ulPom}>
        <div className="komp-slika">
            <li>
          <img src={m1} alt="" />
        </li>
        </div>
         <div className="komp-slika">
            <li>
          <img src={m1} alt="" />
        </li>
        </div> 
        <div className="komp-slika">
            <li>
          <img src={m1} alt="" />
        </li>
        </div> 
         <div className="komp-slika">
            <li>
          <img src={m1} alt="" />
        </li>
        </div> 
         <div className="komp-slika">
            <li>
          <img src={m1} alt="" />
        </li>
        </div> 
         <div className="komp-slika">
            <li>
          <img src={m1} alt="" />
        </li>
        </div> 
        <div className="komp-slika">
            <li>
          <img src={m1} alt="" />
        </li>
        </div>
         <div className="komp-slika">
            <li>
          <img src={m1} alt="" />
        </li>
        </div>
      
       
      </ul>
      </div>
 
      <Naslov podnaslov='u nastavku mozete pogledati listu nasih' naslov='PARTNERA' />
        <div className="lista-komp">
          <StavkaKompanija/>


        </div>
    </div>
  )
}

export default Kompanije