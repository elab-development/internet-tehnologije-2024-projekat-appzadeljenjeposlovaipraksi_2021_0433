
import './App.css';
import Naslov from './komponente/naslov/Naslov';
import Navbar from './komponente/navBar/Navbar';
import PStavka from './komponente/pocetnaStavka/PStavka';
import Pozadina from './komponente/PozadinaPocetna/Pozadina';

function App() {
  return (
        <div id='root'>
      <Navbar/>
      <Pozadina/>
      <Naslov podnaslov='utisci' naslov='Nasih studenata'/>
      <PStavka/>
        </div>
    
  
  );
}

export default App;
