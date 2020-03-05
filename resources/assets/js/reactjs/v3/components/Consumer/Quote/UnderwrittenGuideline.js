import React from 'react';

/** function: UnderwrittenGuideline */
const UnderwrittenGuideline = ({style, link}) => {
    const css = {
        a: {
            color: '#ffffff',
        }
    };
    return (
        link !== "#eApp" && <div className="col-1 link2 rounded-right" style={style}>
            <a className="link right-guide" href={link} style={css.a} title=" Underwriting Guidelines " target="_blank">
                <img src="/images/e-icon.svg" className="e-icon" />
            </a>
        </div>
    );
};


export default UnderwrittenGuideline;