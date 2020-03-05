import React from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types';

/** function: MainMenu */
const MainMenu = (props) => {
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
        let nav = document.getElementById("topnav-ul")

        if (x.className === "topnav") {
            x.className += "responsive";
            nav.className += "show"
        } else {
            x.className = "topnav";
            nav.className = "";
        }
    };

    return (
        <div className="topnav" id="myTopNav">
            <ul id="topnav-ul" style={styles.for.ul}>
                <li>
                    <a href="javascript:void(0);" className="icon" onClick={toggleMenu}>
                        <i className="fa fa-bars"></i>
                    </a>
                </li>
                { menuItems }
            </ul>
        </div>
    );
}

MainMenu.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
};

MainMenu.defaultProps = {
    //myProp: val
};

export default MainMenu;

if (document.getElementById('main-menu')) {
    render(
        <MainMenu />,
        document.getElementById('main-menu')
    );
}