import React from 'react';

/** function: adfasdf */
const adfasdf = () => {
    return (
        <div>
            <div className="row row-odd">

                <div className="col-md-12 company-name">{ item.CompanyName }</div>
                <div className="col-md-3"><img src={item.BannerLogoImageURL} width="132" height="65" alt="" className="company-logo" />
                    <div className="col-md-6">
                        <table className="table table-condensed table-striped _fd3-table-responsive rate-chart">
                            <thead>
                            <tr>
                                <th>
                                    <div className="ucrName">{ item.RateClassification1 }</div>
                                </th>
                                <th>
                                    <div className="ucrName">{ item.RateClassification2 }</div>
                                </th>
                                <th>
                                    <div className="ucrName">{ item.RateClassification3 }</div>
                                </th>
                                <th>
                                    <div className="ucrName">{ item.RateClassification4 }</div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{ item.Rate1Adj }</td>
                                <td>{ item.Rate2Adj }</td>
                                <td>{ item.Rate3Adj }</td>
                                <td>{ item.Rate4Adj }</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div className="col-md-1">
                        <div className="btn-app-request"
                             onClick={event => console.log(event.target.value)}> App Request
                        </div>
                    </div>
                    <div className="col-md-2">
                        <div className="am-rating center-block">A.M. Best:<br /><span className="score">{ item.Rating }</span>
                        </div>
                    </div>
                    <div className="col-md-12">
                        <div className="bottom-bar"><span style={"display:inline-block;float:left;"}>{ item.ProductName }</span><a
                            href="#" style={"color: #FFFFFF;"}
                            onClick={event => console.log(event.target.value)}>Click Here to
                            Match a rate to your Health Profile</a> | <a href="#">ViewPolicy Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default adfasdf;