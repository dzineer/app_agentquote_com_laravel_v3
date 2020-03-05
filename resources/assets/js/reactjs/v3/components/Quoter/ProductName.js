import React from 'react';

/** function: ProductName */
const ProductName = ({style, name}) => {

    return (
        <div className="col-10 product-name rounded-left" style={style}>
            {name}
        </div>
    );
};

export default ProductName;