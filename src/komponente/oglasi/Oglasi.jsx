import React, { useState } from 'react'
import Stavka from '../stavka/Stavka'
import './Oglasi.css'

function Oglasi() {

  const str = 'O';

  const [trenutnaStr, setTrenutnaStr]=useState(1);
  const [filterGrad, setFilterGrad]=useState("");
  const [filterTip, setFilterTip]=useState("");
  const [ukupnoStr, setUkupnoStr] = useState(1);

  const velicinaStr = 6;


  return (
    <div className="oglasi-stranica">
      <div className="filteri">
        <select onChange={(f) => setFilterGrad(f.target.value)}>
          <option value="">Svi gradovi</option>
          <option value="Beograd">Beograd</option>
          <option value="Novi Sad">Novi Sad</option>
          <option value="Niš">Niš</option>

        </select>
          <select onChange={(f) => setFilterTip(f.target.value)}>
          <option value="">Svi tipovi</option>
          <option value="Praksa">Praksa</option>
          <option value="Posao">Posao</option>

        </select>
      </div>
      <div className="lista-oglasa">
        <Stavka 
        stranica={str}
        trenutnaStr={trenutnaStr}
        velicinaStr={velicinaStr}
        filterGrad={filterGrad}
        filterTip={filterTip}
        onUkupnoStr={setUkupnoStr}/>
      </div>

      <div className="paginacija">
        <button onClick={() => setTrenutnaStr(trenutnaStr - 1)} disabled={trenutnaStr === 1}>
          Prethodna
        </button>
        <span>Stranica {trenutnaStr}</span>
        <button onClick={() => setTrenutnaStr(trenutnaStr + 1)} disabled={trenutnaStr >= ukupnoStr}>
          Sledeća
        </button>
      </div>
    </div>
  );
}



export default Oglasi