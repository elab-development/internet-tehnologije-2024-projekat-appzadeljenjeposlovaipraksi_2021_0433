import React, { useState } from 'react'
import './Detalji.css'
import Stavka from '../stavka/Stavka'
import Dugme from '../dugme/Dugme'
import Forma from '../kontakt/Forma';

function Detalji({str}) {

    const[modalOpen, setModalOpen]=useState(false);
    const otvoriModal = ()=>setModalOpen(true);
    const zatvoriModal = ()=> setModalOpen(false);
    

  return (
    <div className='detalji'>
        <div className="zaglavlje">
            <img src="{k.slika}" alt="" />
            <div className="naziv">
                <h2>"k.naziv"</h2>
                <h3>"k.adresa"</h3>
            </div>
        </div>
        {str==='O'?   
         <div className="telo">
            <div className="pozicija">
                <h3>Naziv pozicije</h3>
                <p>opisvnfjnjbjhskkhvbfhvbhvj</p>
            </div>
            <div className="oglas-opis">
                <h3>Opis oglasa</h3>
                <p>fhbhvbhbfhvbhvbhvbfbhf</p>
            </div>
            <div className='dugme' onClick={otvoriModal}>
                <Dugme tekst='Prijavi se'/>
            </div>
            </div> :
                <div className="telo">
            <div className="pozicija">
                <h3>Naziv kompanije</h3>
                <p>opisvnfjnjbjhskkhvbfhvbhvj</p>
            </div>
            <div className="oglas-opis">
                <h3>Opis kompanije</h3>
                <p>fhbhvbhbfhvbhvbhvbfbhf</p>
            </div>
            <div className='ogl'>
            <Stavka stranica={'O'}/>
            <Stavka stranica={'O'}/>
            <Stavka stranica={'O'}/>
            <Stavka stranica={'O'}/>

             </div>
          
            </div>}

            {modalOpen && (
                <div className="modal-overlay" onClick={zatvoriModal}>
                    <div className="modal-content" onClick={(e) => e.stopPropagation()}>
                        <button className='zatvori' onClick={zatvoriModal}>X</button>
                        <Forma/>
                    </div>
                </div>
            )}
    
        </div>
    
  )
}

export default Detalji