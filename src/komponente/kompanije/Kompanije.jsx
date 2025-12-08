import React, { useRef } from 'react'
import './Kompanije.css'
import m1 from '../../assets/meeting1.png'
import m2 from '../../assets/meeting2.png'
import m3 from '../../assets/meeting3.jpg'
import m4 from '../../assets/meeting4.jpg'
import m5 from '../../assets/meeting5.jpg'
import m6 from '../../assets/meeting6.jpg'
import m7 from '../../assets/meeting7.jpg'
import m8 from '../../assets/meeting8.jpg'



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
          <img src={m2} alt="" />
        </li>
        </div> 
        <div className="komp-slika">
            <li>
          <img src={m3} alt="" />
        </li>
        </div> 
         <div className="komp-slika">
            <li>
          <img src={m4} alt="" />
        </li>
        </div> 
         <div className="komp-slika">
            <li>
          <img src={m5} alt="" />
        </li>
        </div> 
         <div className="komp-slika">
            <li>
          <img src={m6} alt="" />
        </li>
        </div> 
        <div className="komp-slika">
            <li>
          <img src={m7} alt="" />
        </li>
        </div>
         <div className="komp-slika">
            <li>
          <img src={m8} alt="" />
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