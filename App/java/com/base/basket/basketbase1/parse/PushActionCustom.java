package com.base.basket.basketbase1.parse;

import android.app.Notification;
import android.app.PendingIntent;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Color;
import android.os.Build;
import android.support.v7.app.NotificationCompat;
import android.util.Log;

import com.base.basket.basketbase1.MainActivity;
import com.base.basket.basketbase1.R;
import com.parse.ParsePushBroadcastReceiver;

import org.json.JSONException;
import org.json.JSONObject;

public class PushActionCustom extends ParsePushBroadcastReceiver{
    private final String TAG = PushActionCustom.class.getSimpleName();

    public PushActionCustom() {
        super();
    }

    @Override
    protected Notification getNotification(Context context, Intent intent) {
        JSONObject pushData = null;
        try{
            pushData = new JSONObject(intent.getExtras().getString("com.parse.Data"));
        } catch (JSONException e) {
            Log.e(TAG, "Push message json exception: " + e.getMessage());
        }

        if(pushData!=null && pushData.has("title") && pushData.has("alert")){
            String titulo = pushData.optString("title");
            String mensaje = pushData.optString("alert");
            String modal = pushData.optString("modal");
            String imagen = pushData.optString("imagen");
            Intent resultIntent;

            SharedPreferences sp=context.getSharedPreferences("PREFERENCE", Context.MODE_PRIVATE);

            switch (modal) {
                case "ofertas":
                    resultIntent = new Intent(context, com.base.basket.basketbase1.ofertas.MainActivity.class);

                    sp.edit().putInt("Popup", 1).apply();
                    sp.edit().putString("titulo", titulo).apply();
                    sp.edit().putString("mensaje", mensaje).apply();
                    sp.edit().putString("imagen", imagen).apply();
                    break;
                case "general":
                    resultIntent = new Intent(context, MainActivity.class);

                    sp.edit().putInt("Popup", 2).apply();
                    sp.edit().putString("titulo", titulo).apply();
                    sp.edit().putString("mensaje", mensaje).apply();
                    sp.edit().putString("imagen", imagen).apply();
                    break;
                default:
                    SharedPreferences equiposFav = context.getSharedPreferences("Favs", 0);
                    int data = pushData.optInt("idNom");
                    if (equiposFav.getInt("id" + data, -99) == data)
                        resultIntent = new Intent(context, MainActivity.class);
                    else
                        return null;
                    break;
            }
            PendingIntent resultPendingIntent = PendingIntent.getActivity(
                    context,
                    0,
                    resultIntent,
                    PendingIntent.FLAG_UPDATE_CURRENT
            );

            int color;

            if(Build.VERSION.SDK_INT>=23)
                color=context.getColor(R.color.colorPrimary);
            else{
                color=Color.rgb(63, 81, 181);
            }

            Notification notification = new NotificationCompat.Builder(
                    context)
                    .setAutoCancel(true)
                    .setSmallIcon(R.drawable.ic_logo)
                    .setContentTitle(titulo)
                    .setContentText(mensaje)
                    .setContentIntent(resultPendingIntent)
                    .setColor(color)
                    .build();
            notification.defaults |= Notification.DEFAULT_VIBRATE;
            return notification;
        }else{
            return null;
        }
    }
}