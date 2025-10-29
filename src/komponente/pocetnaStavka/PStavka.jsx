import React, { useRef } from 'react'
import { GoChevronRight } from "react-icons/go";
import { MdNavigateBefore } from "react-icons/md";
import { MdNavigateNext } from "react-icons/md";
import './PStavka.css'
import user1 from '../../assets/profile1.png'
import user2 from '../../assets/profile2.jpg'
import user3 from '../../assets/profile3.jpg'
import user4 from '../../assets/profile44.jpg'




function PStavka() {
    let naslov="naslov";
    let opis="opis";

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

    <div className='stavka'>
      <button className="before-btn" onClick={before}>
      <MdNavigateBefore />
      </button>
       <button className="next-btn" onClick={next}>
      <MdNavigateNext />
      </button>

      <div className="komentari">
        <ul ref={ulPom}>
          <li>
            <div className="komentar">
              <div className="user-info">
                <img src={user1} alt="" />
                <div>
                  <h3>Aleksandar Stefanovic</h3>
                  <span>FON, Univerzitet u Beogradu</span>
                </div>
              </div>
              <p>„Zahvaljujući ovoj platformi, pronašla sam praksu u firmi 
                koja mi je kasnije ponudila stalno zaposlenje. 
                Interfejs je jednostavan, oglasi su ažurni, 
                a prijava traje svega nekoliko minuta. 
                Preporučila bih ga svakome ko traži ozbiljnu priliku
               za početak karijere.“</p>
            </div>
          </li>
              <li>
            <div className="komentar">
              <div className="user-info">
                <img src={user2} alt="" />
                <div>
                  <h3>Ana Markovic</h3>
                  <span>FON, Univerzitet u Beogradu</span>
                </div>
              </div>
              <p>„Zahvaljujući ovoj platformi, pronašla sam praksu u firmi 
                koja mi je kasnije ponudila stalno zaposlenje. 
                Interfejs je jednostavan, oglasi su ažurni, 
                a prijava traje svega nekoliko minuta. 
                Preporučila bih ga svakome ko traži ozbiljnu priliku
               za početak karijere.“</p>
            </div>
          </li>    <li>
            <div className="komentar">
              <div className="user-info">
                <img src={user3} alt="" />
                <div>
                  <h3>Iva Jovanic</h3>
                  <span>FON, Univerzitet u Beogradu</span>
                </div>
              </div>
              <p>„Zahvaljujući ovoj platformi, pronašla sam praksu u firmi 
                koja mi je kasnije ponudila stalno zaposlenje. 
                Interfejs je jednostavan, oglasi su ažurni, 
                a prijava traje svega nekoliko minuta. 
                Preporučila bih ga svakome ko traži ozbiljnu priliku
               za početak karijere.“</p>
            </div>
          </li>    <li>
            <div className="komentar">
              <div className="user-info">
                <img src={user4} alt="" />
                <div>
                  <h3>Marko Mitic</h3>
                  <span>FON, Univerzitet u Beogradu</span>
                </div>
              </div>
              <p>„Zahvaljujući ovoj platformi, pronašla sam praksu u firmi 
                koja mi je kasnije ponudila stalno zaposlenje. 
                Interfejs je jednostavan, oglasi su ažurni, 
                a prijava traje svega nekoliko minuta. 
                Preporučila bih ga svakome ko traži ozbiljnu priliku
               za početak karijere.“</p>
            </div>
          </li>
        </ul>
        </div>
    </div>
    

  )
}

export default PStavka