import React from 'react';

/** function: ProductGuide */
const ProductGuide = ({style, link}) => {
    const css = {
        a: {
            color: '#ffffff',
        }
    };

    return (
        link !== "#AgentGuide" &&
            <div className="col-1 link1" style={style}>
                <a className="link" href={link} style={css.a} target="_blank" title=" Guide " >
                    <i className="fa fa-file-text" aria-hidden="true"></i>
                </a>
            </div>
    );
};

export default ProductGuide;