package com.base.basket.basketbase2.noticias;

import android.content.Context;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ListView;
import android.widget.RelativeLayout;

import com.base.basket.basketbase2.R;

import java.util.ArrayList;

public class NoticiasFragment extends Fragment {
    private static int idclub=1;
    private static int idprov=-99;

    public static ArrayList<String> tit_lista, subtit_lista, img_lista, cuerpo_lista;
    public static ListView lista;
    public static RelativeLayout preData;

    private static GetNoticias staticGn;

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View fragView= inflater.inflate(R.layout.tab_noticias, container, false);
        String peticion="noticias";

        preData=(RelativeLayout) fragView.findViewById(R.id.preData);
        lista = (ListView) fragView.findViewById(R.id.listaNoticias);
        tit_lista=new ArrayList<>();
        subtit_lista=new ArrayList<>();
        cuerpo_lista=new ArrayList<>();
        img_lista=new ArrayList<>();

        if(idclub!=-99){
            peticion+="?idclub="+idclub;
        }
        else if(idprov!=-99){
            peticion+="?idprov="+idprov;
        }
        else{
            peticion+="?idclub=1";
        }

        GetNoticias gn=new GetNoticias(getContext());
        gn.execute(peticion);

        staticGn=new GetNoticias(getContext());

        return fragView;
    }

    public static void initAdapter(Context context){
        final NoticiasArrayAdapter adapter = new NoticiasArrayAdapter(context, tit_lista, subtit_lista, cuerpo_lista, img_lista);
        lista.setAdapter(adapter);
        preData.setVisibility(View.GONE);
    }

    public static void setIdClub(int i) {
        preData.setVisibility(View.VISIBLE);
        tit_lista=new ArrayList<>();
        subtit_lista=new ArrayList<>();
        cuerpo_lista=new ArrayList<>();
        img_lista=new ArrayList<>();
        if(i!=0) {
            staticGn.execute("noticias?idclub=" + i);
        }
        else{
            staticGn.execute("noticias");
        }
    }

    public static void setIdProv(int i) {
        idprov=i;
    }
}
