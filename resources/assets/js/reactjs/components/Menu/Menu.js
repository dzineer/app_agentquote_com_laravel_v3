import React, {Component} from 'react';
import PropTypes from 'prop-types';

class Menu extends Component {
    constructor(props) {
        super(props);
        this.state = {};
    }

    render() {
        const { items, className, styles } = this.props;
        return (
            <ul>
                {
                    items.map(item => {
                        return <li key={item.text}>
                                    <a href={item.link}>{item.text}</a>
                              </li>
                    })
                }
            </ul>
        );
    }
}

Menu.propTypes = {
    /** Array of link items */
    items: PropTypes.array.isRequired,

    /** ClassName */
    className: PropTypes.string,

    /** Inline Styles */
    styles: PropTypes.object
};

Menu.defaultProps = {
    items: []
};

export default Menu;
