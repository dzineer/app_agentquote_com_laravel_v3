import React from 'react';

/** function: ProductGuide */
const ProductGuide = ({style, link}) => {
    return (
        <div className="col-4" style={style}>
            <a className="link" href={link}>Product Guide</a>
        </div>
    );
};

export default ProductGuide;