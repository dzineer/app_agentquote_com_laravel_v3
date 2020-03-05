import React from 'react';

/** function: ProductName */
const ProductName = ({style, name}) => {
    return (
        <div className="col product-name" style={style}>
            {name}
        </div>
    );
};

export default ProductName;