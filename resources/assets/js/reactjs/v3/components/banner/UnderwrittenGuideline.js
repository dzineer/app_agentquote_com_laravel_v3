import React from 'react';

/** function: UnderwrittenGuideline */
const UnderwrittenGuideline = ({style, link}) => {
    return (
        <div className="col-4" style={style}>
            <a className="link" href={link}>Underwritten Guide</a>
        </div>
    );
};

export default UnderwrittenGuideline;