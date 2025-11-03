import React from 'react'
import './Detalji.css'
import Stavka from '../stavka/Stavka'

function Detalji({str}) {

    

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
            <Stavka/>
            <Stavka/>
            <Stavka/>
            <Stavka/>

             </div>
          
            </div>}
    
        </div>
    
  )
}

export default Detalji