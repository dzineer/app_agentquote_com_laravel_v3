import React from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types';

/** function: MainMenu */
const MainMenu2 = (props) => {
    const styles = {
      for: {
          ul: {
              listStyle: 'none', 
              lineHeight: '42px', 
              width: '850px',
              paddingLeft: '120px',
              margin: '0 auto',
              display: 'inline-block'
          },
          li: {
              display: 'inline-block',
          },
          a: {
              color: '#fff',
              padding: '0px 15px',
              borderLeft: '1px solid #0000002b'
          }
      }
    };

    const menuItems = [{text: 'Termlife Insurance', position: 1}, {text: 'Simplified Issue', position: 2}, {text: 'Final Expense', position: 3}, {text: 'GUL', position: 4}].map( item => {
       return  (
                 <li style={styles.for.li} key={item.position}>
                     <a href="#" style={styles.for.a}>{item.text}</a>
                 </li>
       );
    });

    const toggleMenu = event => {
        let x = document.getElementById("myTopNav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    };

    return (
        <div class="menu-container">
            <div className="topnav" id="myTopNav">
                <a href="#term" className="active">Termlife</a>
                <a href="#news">Simplified Issue</a>
                <a href="#contact">Simplified Issue Whole Life</a>
                <a href="#about">Gul</a>

            </div>
            <a id="hamburger" href="javascript:void(0);" className="icon" onClick={toggleMenu}>
                <i className="fa fa-bars"></i>
            </a>
        </div>
    );
}

MainMenu2.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
};

MainMenu2.defaultProps = {
    //myProp: val
};

export default MainMenu2;

if (document.getElementById('main-menu')) {
    render(
        <MainMenu2 />,
        document.getElementById('main-menu')
    );
}