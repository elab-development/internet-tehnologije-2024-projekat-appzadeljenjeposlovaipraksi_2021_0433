import React from 'react'
import logo1 from '../../assets/lidl.png'
import './StavkaKompanije.css'
import { useNavigate } from 'react-router-dom';
import { IoLocationOutline } from "react-icons/io5";


function StavkaKompanija() {
    let nazivKomp='Lidl';
    let lokacija='Beograd';
    let stanje='2';
    let id='k1';
    
  
  

    const navigate=useNavigate()
   const otvoriKomp = ()=>{
      navigate(`/detaljiKompanija:${id}`);
    }

  return (
    <div className='KStavka' onClick={otvoriKomp}>
        <img src={logo1} alt="" />
         <div className="overlay">
         <h3>Prikaži detalje o kompaniji</h3> 
         </div>
         <div  className="komp-detalji">
                <div className="naziv">
                <h1>{nazivKomp}</h1>
                </div>
             <label>
                <div className="lokacija">
                <IoLocationOutline />
                <h2>{lokacija}</h2>
                </div>
            </label>
          
        </div>
        <div className="stanje">
                <h3>Trenutno aktivno oglasa:{stanje}</h3>
              </div>
        
        
    </div>
  )
}

export default StavkaKompanija