import React, { useState } from 'react'
import './Forma.css'

function Forma( {str}) {


    const [ime,setIme]=useState("");
    const [prezime, setPrezime]=useState("");
    const [email,setEmail]=useState("");
    const [poruka,setPoruka]=useState("");
    const [telefon, setTelefon] = useState("");
    const [prebivaliste, setPrebivaliste] = useState("");
    const [ustanova, setUstanova] = useState("");
    const[obrazovanje, setObrazovanje]=useState("")
  return (
    <div className='forma'>
        <form action="submit">
            <label>
                <p>Ime: </p>
                <input 
                type="text"
                value={ime}
                onChange={(e) => setIme(e.target.value)}
                required/>
            </label>
            <label>
                <p>Prezime: </p>
                <input type="text"
                value={prezime}
                onChange={(e) => setPrezime(e.target.value)}
                required />
            </label>
            <label>
                <p>Email: </p>
                <input type="email" 
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                required/>
            </label>
            {str==='K' ?
            <>
               <label>
                <p>Poruka: </p>
                <textarea 
                value={poruka}
                onChange={(e) => setPoruka(e.target.value)}
                required/>
                </label>
                <div className='dugme'>
                    <button type='submit'>Posalji</button>
                </div>
            </>
             :  
             <>
             <label>
                <p>Telefon: </p>
                <input type="text"
                value={telefon}
                required />
            </label>
            <label>
                <p>Prebivalište: </p>
                <input type="text"
                value={prebivaliste}
                required />
            </label>
            <select value={obrazovanje} onChange={(e) => setObrazovanje(e.target.value)}>
                <option value="">Odaberi stepen obrazovanja</option>
                <option value="srednja">Srednja škola</option>
                <option value="visa">Viša škola</option>
                <option value="oas">Osnovne studije</option>
                <option value="master">Magistarske studije</option>
            </select>
               <label>
                <p>Naziv obrazovne ustanove: </p>
                <input type="text"
                value={ustanova}
                required />
            </label>

            <div className='dugme'>
                <button type='submit'>Prijavi se</button>
            </div>

             </>}
         
            
        </form>
    </div>
  )
}

export default Forma