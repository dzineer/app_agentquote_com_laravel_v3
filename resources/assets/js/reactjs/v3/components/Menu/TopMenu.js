import React from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types';

/** function: TopMenu */
const TopMenu = (props) => {
    const styles = {
      for: {
          topMenu: {
              height: '40px',
              color: '#fff',
              bottom: '30px',
              position: 'absolute',
              width: '100%',
              right: '150px'
          },
          ul: {
              listStyle: 'none', 
              lineHeight: '42px', 
              display: 'inline-block', 
              float: 'right',
          },
          li: {
              display: 'inline-block',
          },
          a: {
              first: {
                  color: '#808080',
                  padding: '0px 15px'
              },
              others: {
                  color: '#808080',
                  padding: '0px 15px',
                  borderLeft: '1px solid #0000002b'
              }
          }
          
      }  
    };

    const menuItems = [{text: 'NEEDS ANALYZER', position: 1}, {text: 'CONTACT', position: 2}].map( item => {
       let style = {
           li: {},
           a: {}
       };

       style.a = item.position === 1 ? styles.for.a.first : styles.for.a.others;

       return  (
                 <li style={styles.for.li} key={item.position}>
                     <a href="#" style={style.a}>{item.text}</a>
                 </li>
       );
    });

    return (
        <div>
            <div className="top-menu" style={styles.for.topMenu}>
                <ul style={styles.for.ul}>
                    { menuItems }
                </ul>
            </div>
        </div>
    );
}

TopMenu.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
};

TopMenu.defaultProps = {
    //myProp: val
};

export default TopMenu;

if (document.getElementById('top-menu')) {
    render(
        <TopMenu />,
        document.getElementById('top-menu')
    );
}