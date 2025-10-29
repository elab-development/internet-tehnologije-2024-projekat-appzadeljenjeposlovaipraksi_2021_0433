
import { DiVim } from 'react-icons/di';
import './App.css';
import Naslov from './komponente/naslov/Naslov';
import Navbar from './komponente/navBar/Navbar';
import PStavka from './komponente/pocetnaStavka/PStavka';
import Pozadina from './komponente/PozadinaPocetna/Pozadina';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import Oglasi from './komponente/oglasi/Oglasi';
function App() {
  return (
    <BrowserRouter>
      <Navbar/>
        <Routes>
          <Route path='/' element={
            <div>
              <Pozadina/>
              <Naslov podnaslov='utisci' naslov='Nasih studenata'/>
              <PStavka/>
            </div>
          }>
          </Route>
            <Route path='/oglasi' element={<Oglasi/>}>
          </Route>
      </Routes>
      
        </BrowserRouter>
    
  
  );
}

export default App;
