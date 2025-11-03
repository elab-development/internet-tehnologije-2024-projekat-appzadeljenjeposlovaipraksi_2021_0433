import React from 'react'
import { MdWorkOutline } from "react-icons/md";
import { IoLocationOutline } from "react-icons/io5";
import './Stavka.css'
import logo1 from '../../assets/lidl.png'
import { useNavigate } from 'react-router-dom';

function Stavka({stranica}) {

    let nazivKomp='Lidl';
    let lokacija='Beograd'
    let nazivPozicije="Menadzer prodaje"
    let rok="12.12.2025"
    let vrsta="Praksa"
    const id='o1';

    const navigate=useNavigate()
    const otvoriOglas = ()=>{
      navigate(`/detaljiOglas/${id}`);
    }

  return (
    <div className='OStavka' onClick={otvoriOglas}>
        <img src={logo1} alt="" />
         <div className="overlay">
          {stranica === 'O'? 
          <h3>Prikaži oglas</h3> : <h3>Prikaži detalje o kompaniji</h3> }
         </div>
        {stranica === 'O'?  
         <div className='opis'>
        <h3>{nazivPozicije}</h3>
        <h3>Rok za prijavu:{rok}</h3>
        </div> : <></> }
        <div  className= {stranica === 'O'? "Okomp-info" : "Kkomp-info"}>
            <label>
                <div className="naziv">
                <MdWorkOutline />
                <h3>{nazivKomp}</h3>
                </div>
            </label>
             <label>
                <div className="lokacija">
                <IoLocationOutline />
                <h3>{lokacija}</h3>
                </div>
            </label>
            <label>
              <div className="vrsta">
                <h3>{vrsta}</h3>
              </div>
            </label>
        </div>
        
        
    </div>
  )
}

export default Stavka