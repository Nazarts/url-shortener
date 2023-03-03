function makeRequest(url, data) {
    const httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = () => {showResponse(httpRequest)};
    httpRequest.open("POST", url);
    httpRequest.setRequestHeader(
        "Content-Type",
        "application/json"
      );
      httpRequest.setRequestHeader(
        "Accept",
        "application/json"
      );
    httpRequest.send(JSON.stringify(data));
}

function showResponse(httpRequest) {
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
      if (httpRequest.status === 200) {
        document.getElementById("url-response").innerText = JSON.parse(httpRequest.responseText)['url'];
        document.getElementById('hide-form').classList.remove('hide');
      } else {
        alert("There was a problem with the request.");
      }
    }
}

document.getElementById("submit-btn").onclick = () => {
    var form = document.querySelector('form');
    if (form.reportValidity()){
        const original_url = document.getElementById("original-url").value;
        makeRequest("api/urls", {'original_url': original_url});
    }
};

document.getElementById("ico-btn").onmousedown = (element) => {
    const copyText = document.getElementById("url-response").innerText;
    navigator.clipboard.writeText(copyText);
    document.getElementById('copy-alert').classList.add('animate');
    setTimeout(() => {
        document.getElementById('copy-alert').classList.remove('animate');
    }, 4000);
}