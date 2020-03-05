                function PackageData(dataToPackage) {
                    let work = dataToPackage;
                    let adj = work.length % 3;
                    if (adj !== 0) {
                        for (var indx = 0; indx < (3 - adj); indx++) {
                            work = work + ' ';
                        }
                    }
                    let tab = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
                    let out = "",
                        c1, c2, c3, e1, e2, e3, e4;
                    for (let i = 0; i < work.length;) {
                        c1 = work.charCodeAt(i++);
                        c2 = work.charCodeAt(i++);
                        c3 = work.charCodeAt(i++);
                        e1 = c1 >> 2;
                        e2 = ((c1 & 3) << 4) + (c2 >> 4);
                        e3 = ((c2 & 15) << 2) + (c3 >> 6);
                        e4 = c3 & 63;
                        if (isNaN(c2)) {
                            e3 = e4 = 64;
                        } else if (isNaN(c3)) {
                            e4 = 64;
                        }
                        out += tab.charAt(e1) + tab.charAt(e2) + tab.charAt(e3) + tab.charAt(e4);
                    }
                    return out;
                }

                let signupInfo = {};
                signupInfo.account = {};
                signupInfo.account = {};
                signupInfo.account.type = 'affiliate';
                signupInfo.user = {};
                signupInfo.user.userName = 'some_name';

                signupInfo.site = {};
                signupInfo.siteId = 'aqterm';
                signupInfo.request = 'availability';
                signupInfo.type = 'affiliate';
                signupInfo.mode = 'affiliate';

                let packagedSignUpInfoData = PackageData(JSON.stringify(signupInfo));

                const thePackageObject = {
                    "params": {
                        "data": packagedSignUpInfoData
                    }
                };

                let packagedData = JSON.stringify(thePackageObject);
                let url_request = "https://somedomain.com/aqmprocess";

                $.ajax({

                    url: "https://somedomain.com/aqmprocess",
                    type: 'put',
                    data: packagedData,
                    dataType: "json",
                    cache: false,

                    error: function (response) {
                        console.log(response);
                    },
                    success: function (response) {

                        if (response.successful === true) {
                            console.log(response);
                        } else if (response.successful === false) { // we have a form error
                            console.log(response);
                        }
                    }
                });
