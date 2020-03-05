import React from 'react';
import PropTypes from 'prop-types';
import Item from '../Item';

const List = ({htmlId, className, styles, items, type, ...props}) => {
    return (
        type === 'unordered' ?
        <ul id={htmlId} className={className} style={styles}>
            {
                items.map(item => {
                 return   <Item
                            key={item}
                            id={item.id}
                            className={item.className}
                            style={item.styles}>
                            {item.child}
                          </Item>
                })
            }
        </ul>
            :
        <ol id={htmlId} className={className} style={styles}>
            {
                items.map(item => {
                    return   <Item
                               key={item}
                               id={item.id}
                               className={item.className}
                               style={item.styles}>
                               {item.child}
                            </Item>
                })
            }
        </ol>

    );
};

List.protoTypes = {
    /** htmlId */
    htmlId: PropTypes.string,

    /** List of Items */
    items: PropTypes.array,

    /** ClassName */
    className: PropTypes.string,

    /** Inline Styles */
    styles: PropTypes.object,

    /** list type */
    type: PropTypes.oneOf(['order', 'un-ordered']),
};

List.defaultProps = {
    htmlId: '',
    items: [],
    type: 'unordered'
};

export default List;