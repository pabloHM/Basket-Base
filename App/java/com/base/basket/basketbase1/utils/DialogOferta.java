package com.base.basket.basketbase1.utils;

import android.app.Dialog;
import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.v4.app.DialogFragment;
import android.support.v7.app.AlertDialog;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.base.basket.basketbase1.MainActivity;
import com.base.basket.basketbase1.R;
import com.base.basket.basketbase1.ofertas.GetImage;

public class DialogOferta extends DialogFragment {
    private static TextView ofertaTit, cuerpoOferta;
    private static ImageView imgOferta;
    private static RelativeLayout preImg;

    public DialogOferta(){}

    @NonNull
    @Override
    public Dialog onCreateDialog(Bundle savedInstanceState) {
        AlertDialog.Builder builder = new AlertDialog.Builder(getActivity());
        LayoutInflater inflater = getActivity().getLayoutInflater();

        View dialog=inflater.inflate(R.layout.dialog_oferta, null);

        ofertaTit=(TextView) dialog.findViewById(R.id.empresa);
        cuerpoOferta=(TextView) dialog.findViewById(R.id.cuerpoOferta);
        imgOferta=(ImageView) dialog.findViewById(R.id.imgOferta);
        preImg=(RelativeLayout) dialog.findViewById(R.id.preImg);

        ofertaTit.setText(MainActivity.titOferta);
        cuerpoOferta.setText(MainActivity.menOferta);

        GetImage gi=new GetImage(imgOferta, preImg, MainActivity.imgOferta);
        gi.execute();

        builder.setView(dialog);

        return builder.create();
    }
}