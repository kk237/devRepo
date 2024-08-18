'use strict';

// 画面スクロール時に処理を実行
window.addEventListener('scroll', function(){

    // スクロール量を取得
    const scroll = window.scrollY;

    // デバッグ用
    // console.log(scroll);

    // 画面の高さを取得
    const windowHeight = window.innerHeight;

    // デバッグ用
    // console.log(windowHeight);

    // 全てのfadeInItemsクラスの要素を取得
    const fadeInItems = document.querySelectorAll('.fadeInItems');

    // デバッグ用
    // console.log(fadeInItems);

    fadeInItems.forEach(function(fadeInItem) {

        // fadeInItemまでの高さを取得
        const distanceTofadeInItem = fadeInItem.offsetTop;

        // デバッグ用
        // console.log(distanceTofadeInItem);

        // 「スクロール量+画面の高さ」が「fadeInItemまでの高さ」より大きい場合、処理を実行
        if (scroll + windowHeight > (distanceTofadeInItem+(windowHeight/2))) {

            // fadeInItemsクラスの要素にfadeInクラスを追加
            fadeInItem.classList.add('fadeIn');
        }
    });

}, false);
