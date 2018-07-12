const instagram = (function() {
  'use strict';

  let _this = {
    connect: connect,
    getUserData: getUserData,
    getUserContent: getUserContent,
    getTagContent: getTagContent,
    renderTiles: renderTiles,
    setMaxTiles: setMaxTiles
  }

  let access_token = null;
  function connect(token) {
    access_token = token;
    return _this;
  }

  function retrieveFrom(endpoint) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: endpoint,
        success: response => resolve(response),
        error: response => reject(response),
      })
    });
  }

  function getUserData(token){
      let endpoint = `https://api.instagram.com/v1/users/self/?access_token=${ access_token }`;
      return retrieveFrom(endpoint);
  }

  function getUserContent(token){
      let endpoint = `https://api.instagram.com/v1/users/self/media/recent/?access_token=${ access_token }`;
      return retrieveFrom(endpoint);
  }

  function getTagContent(tag) {
    let endpoint = `https://api.instagram.com/v1/tags/${ tag }?access_token=${ access_token }`;
    return retrieveFrom(endpoint);
  }

  function renderTiles(el, tileArr) {
    let target = $(el);
    tileArr.some((tile, i)=> {
      if (i == maxTiles) return true;
      target.append(createTile(tile));
    });
  }

  let maxTiles = 8;
  function setMaxTiles(max) {
    maxTiles = max;
  }

  function createTile(data) {
    let caption = data.caption ? data.caption.text: 'View on Instagram';
    let tile = JSX.html('figure', {
      className: 'insta-tile m-3 z-depth-1 z-hover pointer',
      onClick: () => window.open(data.link, '_blank')
    }, [
      JSX.html('div', {className: 'overlay white light'}),
      JSX.html('img', {src: data.images.low_resolution.url}),
      JSX.html('div', {className: 'insta-gone text-white'
      }, [JSX.html('i', {className: 'fas fa-external-link-alt text-white'})]),
      JSX.html('div', {className: 'p-2 d-flex align-items-center to-instagram'
      }, [
        JSX.html('i', {className: 'fab fa-instagram mr-2'}),
        JSX.html('p', {className: 'm-0 dot-dot-dot normal'}, [caption])
      ])
    ]);
    return JSX.createElement(tile);
  }

  return _this;

}());

export { instagram };
