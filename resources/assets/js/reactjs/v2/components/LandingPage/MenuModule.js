import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {render} from "react-dom";

/** class MenuModule */
class MenuModule extends Component {

    constructor(props) {
        super(props);
        this.state = {
            menus: [],
            show: false
        };
    }

    componentDidMount() {
        debugger;
        this.setState({
            menus: this.props.menus,
            show: this.props.show
        })
    }

    render() {

        debugger;

        let menu = this.state.menus.map( menu => {
           return menu.active ? <li className="active"><a href={ menu.link }>{ menu.label }</a></li> :
               <li><a href={ menu.link }>{ menu.label }</a></li>
        });

        return (
            this.state.show && <div>
                <ul className="rd-navbar-nav">
                   { menu }
                </ul>
            </div>
        );
    }
}

MenuModule.propTypes = {
    show: PropTypes.bool.isRequired,
    menus: PropTypes.array.isRequired
    //myProp: PropTypes.string.isRequired
};

MenuModule.defaultProps = {
    //myProp: val
};

export default MenuModule;

if (document.getElementById('menu-module')) {
    render(
        <MenuModule show={ showMenu } menus={ menus } />,
        document.getElementById('menu-module')
    );
}
