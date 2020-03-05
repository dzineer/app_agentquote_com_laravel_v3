import React, { Component } from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types';

/** function: Navigation */
class Navigation extends Component {
    constructor(props)
    {
        super(props);

        this.event = new Event('menuOnClick');
        this.event.initEvent('menuOnClick', true, true);
        this.styles = {
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

        // {text: 'GUL', name: 'gul_menu_item', position: 4}
        this.menuItems = [{text: 'Term Life Insurance', name: 'termlife_menu_item', position: 1},
                          {text: 'Simplified Issue Term', name: 'sit_menu_item', position: 2},
                          {text: 'Final Expense (SIWL)', name: 'siwl_menu_item', position: 3}].map( item => {
           return  (
             <li key={item.name}><a id={item.name} name={item.name} onClick={this.onMenuClick} href="#">{item.text}</a></li>
           );
        });
    }

    toggleMenu = event => {
        let x = document.getElementById("nav-ul");
        if (x.className === "showing") {
            x.className = "";
        } else {
            x.className += "showing";
        }
    };

    onMenuClick = event => {
      this.toggleMenu(null);
      event.target.dispatchEvent(this.event);
    };

    componentDidMount() {

    }

    render() {
        return (
            <div>
                <nav style={ { position: 'relative' }}>
                    <ul id="nav-ul">
                        { this.menuItems }
                    </ul>
                    <div className="handle" onClick={this.toggleMenu}><i className="fa fa-bars"></i></div>
                </nav>
            </div>
        );
    }
};

Navigation.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
};

Navigation.defaultProps = {
    //myProp: val
};

export default Navigation;

if (document.getElementById('main-menu')) {
    render(
        <Navigation />,
        document.getElementById('main-menu')
    );
}