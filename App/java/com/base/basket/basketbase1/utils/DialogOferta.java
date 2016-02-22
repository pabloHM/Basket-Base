package com.base.basket.basketbase1.utils;

import android.app.Dialog;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.v4.app.DialogFragment;
import android.support.v7.app.AlertDialog;
import android.view.LayoutInflater;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.TextView;

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

        builder.setView(inflater.inflate(R.layout.dialog_oferta, null));

        ofertaTit=(TextView) getActivity().findViewById(R.id.empresa);
        cuerpoOferta=(TextView) getActivity().findViewById(R.id.cuerpoOferta);
        imgOferta=(ImageView) getActivity().findViewById(R.id.imgOferta);
        preImg=(RelativeLayout) getActivity().findViewById(R.id.preImg);

        SharedPreferences sp=getContext().getSharedPreferences("PREFERENCE", 0);

        ofertaTit.setText(sp.getString("titulo", ""));
        cuerpoOferta.setText(sp.getString("mensaje", ""));

        GetImage gi=new GetImage(imgOferta, preImg, sp.getString("imagen", ""));
        gi.execute();

        return builder.create();
    }
}