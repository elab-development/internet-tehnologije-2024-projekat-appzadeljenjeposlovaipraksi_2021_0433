import React from 'react'
import { MdWorkOutline } from "react-icons/md";
import { IoLocationOutline } from "react-icons/io5";
import './Stavka.css'
import logo1 from '../../assets/lidl.png'

function Stavka() {

    let nazivKomp='Lidl';
    let lokacija='Beograd'
    let nazivPozicije="Menadzer prodaje"
    let rok="12.12.2025"

  return (
    <div className='OStavka'>
        <img src={logo1} alt="" />
        <div className='opis'>
        <h3>{nazivPozicije}</h3>
        <h3>Rok za prijavu:{rok}</h3>
        </div>
        <div className="komp-info">
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
        </div>
        
        
    </div>
  )
}

export default Stavka