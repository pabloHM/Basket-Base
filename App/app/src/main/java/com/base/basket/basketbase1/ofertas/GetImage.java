package com.base.basket.basketbase1.ofertas;

import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.AsyncTask;
import android.util.Log;
import android.view.View;
import android.widget.ImageView;
import android.widget.RelativeLayout;

import com.base.basket.basketbase1.R;
import com.base.basket.basketbase1.utils.DialogOferta;

import java.io.IOException;
import java.net.MalformedURLException;
import java.net.URL;

public class GetImage extends AsyncTask<Void, Void, Bitmap>{
    private View rowView=null;
    private ImageView ivView=null;
    private RelativeLayout preView=null;
    private String ruta;
    private static final String folder="http://bbpanel.advalleinclan.es/img/ofertas/";

    public GetImage(View rowView, String name){
        this.rowView=rowView;
        ruta=name;
    }

    public GetImage(ImageView ivView, RelativeLayout preView, String name){
        this.ivView=ivView;
        this.preView=preView;
        ruta=name;
    }

    @Override
    protected Bitmap doInBackground(Void... params) {
        Bitmap bm=null;

        try {
            if(!ruta.equals("")){
                URL imageUrl=new URL(folder+ruta);
                bm= BitmapFactory.decodeStream(imageUrl.openConnection().getInputStream());
            }
        } catch (MalformedURLException e) {
            Log.e("MalformedURLException", e.toString());
        } catch (IOException e) {
            Log.e("IOException", e.toString());
        }

        return bm;
    }

    @Override
    protected void onPostExecute(Bitmap bitmap) {
        if(bitmap!=null) {
            if(rowView!=null) {
                ImageView iv = (ImageView) rowView.findViewById(R.id.imgOferta);
                iv.setImageBitmap(bitmap);
                rowView.findViewById(R.id.preImg).setVisibility(View.GONE);
            }
            else{
                ivView.setImageBitmap(bitmap);
                preView.setVisibility(View.GONE);
            }
        }
        else{
            if(rowView!=null) {
                rowView.findViewById(R.id.preImg).setVisibility(View.GONE);
            }
            else{
                preView.setVisibility(View.GONE);
            }
        }
    }
}
