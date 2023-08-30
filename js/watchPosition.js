let totalMovement = 0;                      // 総移動距離
let isSetInitialPosition = false;           // （対象地域における）初期位置が設定されたか

const storedTotalMovement = Number(localStorage.getItem("totalMovement"));  // ローカルストレージに保存されている移動距離の記録を読み込み

const HORIZONTAL_ANGLE = 180;               // 水平角
const ONE_REVOLUTION_ANGLE = 360;           // 一回転の角度
const EQUATORIAL_CIRCUMFERENCE = 40076500;  // 赤道円周
const MERIDIAN_CIRCUMFERENCE = 40008600;    // 子午線円周

// 旦過市場の緯度経度範囲
const UPPER_LATITUDE_LIMIT = 33.884;
const LOWER_LATITUDE_LIMIT = 33.876;
const UPPER_LONGITUDE_LIMIT = 130.884;
const LOWER_LONGITUDE_LIMIT = 130.876;

// 前回取得した位置情報
const prevPosition = {
  latitude: 0,
  longitude: 0,
};

if (storedTotalMovement) {  // ローカルストレージに保存されている移動距離の記録がある場合
  // 総移動距離の初期値を記録に合わせる
  totalMovement = storedTotalMovement;

  console.log("ローカルストレージからこれまでの移動距離を読み込みました。")
}

const resetRecord = () => {
  totalMovement = 0;

  console.log("記録がリセットされました。");
}

// ページ終了時に総移動距離をローカルストレージに保存
const pageUnload = () => localStorage.setItem("totalMovement", totalMovement);
window.addEventListener("unload", pageUnload);

// 前回取得した位置情報の設定
const setPrevPosition = (latitude, longitude) => {
  prevPosition.latitude = latitude;
  prevPosition.longitude = longitude;

  console.log("現在位置が更新されました。");
  console.log("現在位置は北緯" + latitude + "°、東経" + longitude + "°です。");
}

// 対象地域にいるかどうか
const isInTargetArea = (latitude, longitude) =>
  latitude < UPPER_LATITUDE_LIMIT
  && latitude > LOWER_LATITUDE_LIMIT
  && longitude < UPPER_LONGITUDE_LIMIT
  && longitude > LOWER_LONGITUDE_LIMIT;

// 移動距離を算出
const getMovement = (latitude, longitude) => {
  const latitudeMovement = Math.abs(prevPosition.latitude - latitude);    // 緯度の移動 [°]
  const longitudeMovement = Math.abs(prevPosition.longitude - longitude); // 経度の移動 [°]

  // 現在の緯度における（地球の）水平方向の円周
  const curLatitudeCircumference = EQUATORIAL_CIRCUMFERENCE * Math.cos(longitudeMovement * (Math.PI / HORIZONTAL_ANGLE))

  // 横方向の移動 [m]（赤道円周 * cos(緯度) / 360° * 緯度の移動）
  const XMovement = curLatitudeCircumference / ONE_REVOLUTION_ANGLE * longitudeMovement;

  // 縦方向の移動 [m]（子午線円周 / 360° * 経度の移動）
  const YMovement = MERIDIAN_CIRCUMFERENCE / ONE_REVOLUTION_ANGLE * latitudeMovement;

  // 移動距離 [m]（√(横方向の移動の2乗 + 縦方向の移動の2乗)）
  const movement = Math.sqrt(XMovement ** 2 + YMovement ** 2);
  return movement;
}

// 位置情報の取得に成功した場合に行われる処理
const watchPositionSuccess = (pos) => {
  const latitude = pos.coords.latitude;
  const longitude = pos.coords.longitude;

  if (isSetInitialPosition) { // （対象地域における）初期位置が設定されている場合
    if (isInTargetArea(latitude, longitude)) {  // 対象地域にいれば
      // 総移動距離と直前に取得した位置情報の更新
      totalMovement += getMovement(latitude, longitude);
      setPrevPosition(latitude, longitude);

      console.log("移動距離が更新されました。");
      console.log("これまでの総移動距離は約" + totalMovement + "mです。");
    }
  } else {  // （対象地域における）初期位置が設定されていない場合
    if (isInTargetArea(latitude, longitude)) {  //対象地域に入ったら
      // 初期位置を設定
      setPrevPosition(latitude, longitude);
      isSetInitialPosition = true;

      console.log("本ページにおける初期位置が設定されました。")
    }
  }
}

// 位置情報を定期的に取得
navigator.geolocation.watchPosition(watchPositionSuccess);
